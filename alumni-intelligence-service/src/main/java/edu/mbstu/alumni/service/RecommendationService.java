package edu.mbstu.alumni.service;

import edu.mbstu.alumni.dto.AlumniRecommendationDTO;
import edu.mbstu.alumni.model.AlumniProfile;
import edu.mbstu.alumni.repository.AlumniProfileRepository;
import lombok.RequiredArgsConstructor;
import lombok.extern.slf4j.Slf4j;
import org.springframework.stereotype.Service;

import java.time.LocalDate;
import java.util.*;
import java.util.stream.Collectors;

@Slf4j
@Service
@RequiredArgsConstructor
public class RecommendationService {
    
    private final AlumniProfileRepository alumniProfileRepository;
    
    /**
     * Generate personalized alumni recommendations based on similarity scoring
     */
    public List<AlumniRecommendationDTO> getRecommendations(Long alumniId, Integer maxResults, String type) {
        log.info("Generating recommendations for alumni ID: {}, type: {}", alumniId, type);
        
        Optional<AlumniProfile> targetAlumniOpt = alumniProfileRepository.findById(alumniId);
        if (targetAlumniOpt.isEmpty()) {
            log.warn("Alumni not found: {}", alumniId);
            return Collections.emptyList();
        }
        
        AlumniProfile targetAlumni = targetAlumniOpt.get();
        List<AlumniProfile> allAlumni = alumniProfileRepository.findAllExcept(alumniId);
        
        List<AlumniRecommendationDTO> recommendations = allAlumni.stream()
            .map(alumni -> calculateSimilarity(targetAlumni, alumni, type))
            .filter(dto -> dto.getSimilarityScore() > 0.3) // Threshold
            .sorted(Comparator.comparing(AlumniRecommendationDTO::getSimilarityScore).reversed())
            .limit(maxResults != null ? maxResults : 10)
            .collect(Collectors.toList());
        
        log.info("Generated {} recommendations", recommendations.size());
        return recommendations;
    }
    
    /**
     * Calculate similarity score between two alumni profiles
     * Uses weighted multi-factor scoring algorithm
     */
    private AlumniRecommendationDTO calculateSimilarity(AlumniProfile target, AlumniProfile candidate, String type) {
        double score = 0.0;
        StringBuilder reason = new StringBuilder();
        
        // Department similarity (20%)
        if (Objects.equals(target.getDepartmentId(), candidate.getDepartmentId())) {
            score += 0.20;
            reason.append("Same department. ");
        }
        
        // Industry similarity (25%)
        if (target.getIndustry() != null && target.getIndustry().equalsIgnoreCase(candidate.getIndustry())) {
            score += 0.25;
            reason.append("Same industry. ");
        }
        
        // Batch year proximity (15%)
        if (target.getBatchYear() != null && candidate.getBatchYear() != null) {
            int yearDiff = Math.abs(target.getBatchYear() - candidate.getBatchYear());
            if (yearDiff == 0) {
                score += 0.15;
                reason.append("Batchmates. ");
            } else if (yearDiff <= 2) {
                score += 0.10;
                reason.append("Close batch years. ");
            } else if (yearDiff <= 5) {
                score += 0.05;
            }
        }
        
        // Career level similarity (15%)
        if (target.getCurrentPosition() != null && candidate.getCurrentPosition() != null) {
            if (isSimilarPosition(target.getCurrentPosition(), candidate.getCurrentPosition())) {
                score += 0.15;
                reason.append("Similar career level. ");
            }
        }
        
        // Major/Degree similarity (10%)
        if (target.getMajor() != null && target.getMajor().equalsIgnoreCase(candidate.getMajor())) {
            score += 0.10;
            reason.append("Same major. ");
        }
        
        // Location similarity (10%)
        if (target.getCity() != null && target.getCity().equalsIgnoreCase(candidate.getCity())) {
            score += 0.10;
            reason.append("Same city. ");
        }
        
        // Type-specific adjustments
        if ("mentorship".equals(type)) {
            // Prefer senior alumni for mentorship
            if (candidate.getGraduationYear() != null && target.getGraduationYear() != null) {
                if (candidate.getGraduationYear() < target.getGraduationYear()) {
                    score += 0.15;
                    reason.append("Potential mentor (senior alumni). ");
                }
            }
        } else if ("batchmates".equals(type)) {
            // Boost same batch year
            if (Objects.equals(target.getBatchYear(), candidate.getBatchYear())) {
                score += 0.30;
            }
        }
        
        return AlumniRecommendationDTO.builder()
            .alumniId(candidate.getId())
            .name(candidate.getUser() != null ? candidate.getUser().getName() : "Unknown")
            .profilePhoto(candidate.getProfilePhoto())
            .currentPosition(candidate.getCurrentPosition())
            .currentCompany(candidate.getCurrentCompany())
            .industry(candidate.getIndustry())
            .batchYear(candidate.getBatchYear())
            .departmentName(candidate.getDepartment() != null ? candidate.getDepartment().getName() : "")
            .similarityScore(Math.round(score * 100.0) / 100.0)
            .recommendationReason(reason.toString().trim())
            .build();
    }
    
    /**
     * Check if two positions are similar using keyword matching
     */
    private boolean isSimilarPosition(String pos1, String pos2) {
        String[] seniorKeywords = {"senior", "lead", "principal", "head", "director", "manager", "chief"};
        String[] juniorKeywords = {"junior", "associate", "assistant", "intern", "trainee"};
        String[] midKeywords = {"engineer", "developer", "analyst", "consultant", "specialist"};
        
        pos1 = pos1.toLowerCase();
        pos2 = pos2.toLowerCase();
        
        // Check if both are senior level
        boolean pos1Senior = Arrays.stream(seniorKeywords).anyMatch(pos1::contains);
        boolean pos2Senior = Arrays.stream(seniorKeywords).anyMatch(pos2::contains);
        if (pos1Senior && pos2Senior) return true;
        
        // Check if both are junior level
        boolean pos1Junior = Arrays.stream(juniorKeywords).anyMatch(pos1::contains);
        boolean pos2Junior = Arrays.stream(juniorKeywords).anyMatch(pos2::contains);
        if (pos1Junior && pos2Junior) return true;
        
        // Check if both contain similar mid-level keywords
        for (String keyword : midKeywords) {
            if (pos1.contains(keyword) && pos2.contains(keyword)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Get networking suggestions - alumni in similar industries or companies
     */
    public List<AlumniRecommendationDTO> getNetworkingSuggestions(Long alumniId, Integer maxResults) {
        return getRecommendations(alumniId, maxResults, "networking");
    }
    
    /**
     * Get mentorship matches - senior alumni who can mentor
     */
    public List<AlumniRecommendationDTO> getMentorshipMatches(Long alumniId, Integer maxResults) {
        return getRecommendations(alumniId, maxResults, "mentorship");
    }
    
    /**
     * Get batchmate suggestions
     */
    public List<AlumniRecommendationDTO> getBatchmates(Long alumniId, Integer maxResults) {
        return getRecommendations(alumniId, maxResults, "batchmates");
    }
}
