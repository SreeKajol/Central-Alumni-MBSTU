package edu.mbstu.alumni.service;

import edu.mbstu.alumni.dto.CareerAnalyticsDTO;
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
public class AnalyticsService {
    
    private final AlumniProfileRepository alumniProfileRepository;
    
    /**
     * Generate comprehensive career analytics for the alumni database
     */
    public CareerAnalyticsDTO getCareerAnalytics(Long departmentId) {
        log.info("Generating career analytics for department: {}", departmentId);
        
        List<AlumniProfile> alumni = departmentId != null 
            ? alumniProfileRepository.findByDepartmentId(departmentId)
            : alumniProfileRepository.findAll();
        
        return CareerAnalyticsDTO.builder()
            .totalAlumni((long) alumni.size())
            .industryDistribution(getIndustryDistribution(alumni))
            .topCompanies(getTopCompanies(alumni))
            .graduationYearDistribution(getGraduationYearDistribution(alumni))
            .averageYearsOfExperience(calculateAverageExperience(alumni))
            .mostCommonCareerPath(getMostCommonCareerPath(alumni))
            .build();
    }
    
    private Map<String, Long> getIndustryDistribution(List<AlumniProfile> alumni) {
        return alumni.stream()
            .filter(a -> a.getIndustry() != null && !a.getIndustry().isEmpty())
            .collect(Collectors.groupingBy(
                AlumniProfile::getIndustry,
                Collectors.counting()
            ))
            .entrySet().stream()
            .sorted(Map.Entry.<String, Long>comparingByValue().reversed())
            .limit(10)
            .collect(Collectors.toMap(
                Map.Entry::getKey,
                Map.Entry::getValue,
                (e1, e2) -> e1,
                LinkedHashMap::new
            ));
    }
    
    private Map<String, Long> getTopCompanies(List<AlumniProfile> alumni) {
        return alumni.stream()
            .filter(a -> a.getCurrentCompany() != null && !a.getCurrentCompany().isEmpty())
            .collect(Collectors.groupingBy(
                AlumniProfile::getCurrentCompany,
                Collectors.counting()
            ))
            .entrySet().stream()
            .sorted(Map.Entry.<String, Long>comparingByValue().reversed())
            .limit(10)
            .collect(Collectors.toMap(
                Map.Entry::getKey,
                Map.Entry::getValue,
                (e1, e2) -> e1,
                LinkedHashMap::new
            ));
    }
    
    private Map<Integer, Long> getGraduationYearDistribution(List<AlumniProfile> alumni) {
        return alumni.stream()
            .filter(a -> a.getGraduationYear() != null)
            .collect(Collectors.groupingBy(
                AlumniProfile::getGraduationYear,
                Collectors.counting()
            ))
            .entrySet().stream()
            .sorted(Map.Entry.comparingByKey())
            .collect(Collectors.toMap(
                Map.Entry::getKey,
                Map.Entry::getValue,
                (e1, e2) -> e1,
                LinkedHashMap::new
            ));
    }
    
    private Double calculateAverageExperience(List<AlumniProfile> alumni) {
        int currentYear = LocalDate.now().getYear();
        
        double avgExperience = alumni.stream()
            .filter(a -> a.getGraduationYear() != null)
            .mapToInt(a -> currentYear - a.getGraduationYear())
            .average()
            .orElse(0.0);
        
        return Math.round(avgExperience * 10.0) / 10.0;
    }
    
    private String getMostCommonCareerPath(List<AlumniProfile> alumni) {
        Map<String, Long> industryCount = alumni.stream()
            .filter(a -> a.getIndustry() != null && !a.getIndustry().isEmpty())
            .collect(Collectors.groupingBy(
                AlumniProfile::getIndustry,
                Collectors.counting()
            ));
        
        return industryCount.entrySet().stream()
            .max(Map.Entry.comparingByValue())
            .map(Map.Entry::getKey)
            .orElse("Not Available");
    }
    
    /**
     * Get industry-specific insights
     */
    public Map<String, Object> getIndustryInsights(String industry) {
        List<AlumniProfile> alumniInIndustry = alumniProfileRepository.findByIndustry(industry);
        
        Map<String, Object> insights = new HashMap<>();
        insights.put("totalAlumni", alumniInIndustry.size());
        insights.put("topCompanies", getTopCompanies(alumniInIndustry));
        insights.put("commonPositions", getCommonPositions(alumniInIndustry));
        insights.put("averageExperience", calculateAverageExperience(alumniInIndustry));
        
        return insights;
    }
    
    private Map<String, Long> getCommonPositions(List<AlumniProfile> alumni) {
        return alumni.stream()
            .filter(a -> a.getCurrentPosition() != null && !a.getCurrentPosition().isEmpty())
            .collect(Collectors.groupingBy(
                AlumniProfile::getCurrentPosition,
                Collectors.counting()
            ))
            .entrySet().stream()
            .sorted(Map.Entry.<String, Long>comparingByValue().reversed())
            .limit(5)
            .collect(Collectors.toMap(
                Map.Entry::getKey,
                Map.Entry::getValue,
                (e1, e2) -> e1,
                LinkedHashMap::new
            ));
    }
}
