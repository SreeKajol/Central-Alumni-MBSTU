package edu.mbstu.alumni.dto;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class AlumniRecommendationDTO {
    private Long alumniId;
    private String name;
    private String profilePhoto;
    private String currentPosition;
    private String currentCompany;
    private String industry;
    private Integer batchYear;
    private String departmentName;
    private Double similarityScore;
    private String recommendationReason;
}
