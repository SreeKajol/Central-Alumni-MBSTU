package edu.mbstu.alumni.controller;

import edu.mbstu.alumni.dto.AlumniRecommendationDTO;
import edu.mbstu.alumni.dto.RecommendationRequest;
import edu.mbstu.alumni.service.RecommendationService;
import lombok.RequiredArgsConstructor;
import lombok.extern.slf4j.Slf4j;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Slf4j
@RestController
@RequestMapping("/api/recommendations")
@RequiredArgsConstructor
@CrossOrigin(origins = {"http://localhost:8000", "http://127.0.0.1:8000"})
public class RecommendationController {
    
    private final RecommendationService recommendationService;
    
    /**
     * Get personalized recommendations for an alumni
     * POST /api/recommendations
     */
    @PostMapping
    public ResponseEntity<List<AlumniRecommendationDTO>> getRecommendations(
            @RequestBody RecommendationRequest request) {
        
        log.info("Received recommendation request: {}", request);
        
        List<AlumniRecommendationDTO> recommendations = recommendationService.getRecommendations(
            request.getAlumniId(),
            request.getMaxResults(),
            request.getRecommendationType()
        );
        
        return ResponseEntity.ok(recommendations);
    }
    
    /**
     * Get networking suggestions
     * GET /api/recommendations/{alumniId}/networking
     */
    @GetMapping("/{alumniId}/networking")
    public ResponseEntity<List<AlumniRecommendationDTO>> getNetworkingSuggestions(
            @PathVariable Long alumniId,
            @RequestParam(defaultValue = "10") Integer maxResults) {
        
        List<AlumniRecommendationDTO> suggestions = recommendationService.getNetworkingSuggestions(
            alumniId, maxResults
        );
        
        return ResponseEntity.ok(suggestions);
    }
    
    /**
     * Get mentorship matches
     * GET /api/recommendations/{alumniId}/mentorship
     */
    @GetMapping("/{alumniId}/mentorship")
    public ResponseEntity<List<AlumniRecommendationDTO>> getMentorshipMatches(
            @PathVariable Long alumniId,
            @RequestParam(defaultValue = "10") Integer maxResults) {
        
        List<AlumniRecommendationDTO> matches = recommendationService.getMentorshipMatches(
            alumniId, maxResults
        );
        
        return ResponseEntity.ok(matches);
    }
    
    /**
     * Get batchmates
     * GET /api/recommendations/{alumniId}/batchmates
     */
    @GetMapping("/{alumniId}/batchmates")
    public ResponseEntity<List<AlumniRecommendationDTO>> getBatchmates(
            @PathVariable Long alumniId,
            @RequestParam(defaultValue = "10") Integer maxResults) {
        
        List<AlumniRecommendationDTO> batchmates = recommendationService.getBatchmates(
            alumniId, maxResults
        );
        
        return ResponseEntity.ok(batchmates);
    }
    
    /**
     * Health check endpoint
     */
    @GetMapping("/health")
    public ResponseEntity<String> health() {
        return ResponseEntity.ok("Alumni Intelligence Service is running!");
    }
}
