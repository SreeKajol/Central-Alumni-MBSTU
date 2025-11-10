package edu.mbstu.alumni.model;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDate;
import java.time.LocalDateTime;

@Data
@Entity
@Table(name = "alumni_profiles")
public class AlumniProfile {
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    
    @Column(name = "user_id")
    private Long userId;
    
    @Column(name = "department_id")
    private Long departmentId;
    
    @Column(name = "student_id")
    private String studentId;
    
    @Column(name = "batch_year")
    private Integer batchYear;
    
    @Column(name = "graduation_year")
    private Integer graduationYear;
    
    private String degree;
    private String major;
    
    @Column(name = "profile_photo")
    private String profilePhoto;
    
    @Column(name = "date_of_birth")
    private LocalDate dateOfBirth;
    
    private String phone;
    private String address;
    private String city;
    private String country;
    
    @Column(name = "current_company")
    private String currentCompany;
    
    @Column(name = "current_position")
    private String currentPosition;
    
    private String industry;
    
    @Column(name = "linkedin_url")
    private String linkedinUrl;
    
    @Column(name = "facebook_url")
    private String facebookUrl;
    
    @Column(name = "twitter_url")
    private String twitterUrl;
    
    @Column(name = "website_url")
    private String websiteUrl;
    
    @Column(columnDefinition = "TEXT")
    private String bio;
    
    @Column(columnDefinition = "JSON")
    private String achievements;
    
    @Column(columnDefinition = "JSON")
    private String publications;
    
    @Column(name = "is_profile_public")
    private Boolean isProfilePublic;
    
    @Column(name = "is_verified")
    private Boolean isVerified;
    
    @Column(name = "created_at")
    private LocalDateTime createdAt;
    
    @Column(name = "updated_at")
    private LocalDateTime updatedAt;
    
    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "user_id", insertable = false, updatable = false)
    private User user;
    
    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "department_id", insertable = false, updatable = false)
    private Department department;
}
