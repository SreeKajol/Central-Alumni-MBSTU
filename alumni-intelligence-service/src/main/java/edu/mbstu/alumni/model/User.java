package edu.mbstu.alumni.model;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDateTime;

@Data
@Entity
@Table(name = "users")
public class User {
    
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    
    private String name;
    private String email;
    
    @Column(name = "email_verified_at")
    private LocalDateTime emailVerifiedAt;
    
    private String password;
    
    @Column(name = "remember_token")
    private String rememberToken;
    
    @Column(name = "created_at")
    private LocalDateTime createdAt;
    
    @Column(name = "updated_at")
    private LocalDateTime updatedAt;
    
    @Enumerated(EnumType.STRING)
    private UserRole role;
    
    @Column(name = "department_id")
    private Long departmentId;
}
