package edu.mbstu.alumni.controller;

import edu.mbstu.alumni.dto.CareerAnalyticsDTO;
import edu.mbstu.alumni.service.AnalyticsService;
import lombok.RequiredArgsConstructor;
import lombok.extern.slf4j.Slf4j;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Map;

@Slf4j
@RestController
@RequestMapping("/api/analytics")
@RequiredArgsConstructor
@CrossOrigin(origins = {"http://localhost:8000", "http://127.0.0.1:8000"})
public class AnalyticsController {
    
    private final AnalyticsService analyticsService;
    
    /**
     * Get career analytics
     * GET /api/analytics/career?departmentId=1
     */
    @GetMapping("/career")
    public ResponseEntity<CareerAnalyticsDTO> getCareerAnalytics(
            @RequestParam(required = false) Long departmentId) {
        
        log.info("Fetching career analytics for department: {}", departmentId);
        
        CareerAnalyticsDTO analytics = analyticsService.getCareerAnalytics(departmentId);
        return ResponseEntity.ok(analytics);
    }
    
    /**
     * Get industry-specific insights
     * GET /api/analytics/industry/{industry}
     */
    @GetMapping("/industry/{industry}")
    public ResponseEntity<Map<String, Object>> getIndustryInsights(
            @PathVariable String industry) {
        
        log.info("Fetching insights for industry: {}", industry);
        
        Map<String, Object> insights = analyticsService.getIndustryInsights(industry);
        return ResponseEntity.ok(insights);
    }
}
