package edu.mbstu.alumni.dto;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.Map;

@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class CareerAnalyticsDTO {
    private Map<String, Long> industryDistribution;
    private Map<String, Long> topCompanies;
    private Map<Integer, Long> graduationYearDistribution;
    private Double averageYearsOfExperience;
    private String mostCommonCareerPath;
    private Long totalAlumni;
}
