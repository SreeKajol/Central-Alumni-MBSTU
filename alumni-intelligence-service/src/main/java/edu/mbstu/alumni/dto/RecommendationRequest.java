package edu.mbstu.alumni.dto;

import lombok.Data;

@Data
public class RecommendationRequest {
    private Long alumniId;
    private Integer maxResults = 10;
    private String recommendationType; // "networking", "mentorship", "career_path", "batchmates"
}
