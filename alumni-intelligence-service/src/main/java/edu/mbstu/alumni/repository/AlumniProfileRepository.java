package edu.mbstu.alumni.repository;

import edu.mbstu.alumni.model.AlumniProfile;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface AlumniProfileRepository extends JpaRepository<AlumniProfile, Long> {
    
    List<AlumniProfile> findByDepartmentId(Long departmentId);
    
    List<AlumniProfile> findByBatchYear(Integer batchYear);
    
    List<AlumniProfile> findByIndustry(String industry);
    
    List<AlumniProfile> findByIsProfilePublicTrue();
    
    @Query("SELECT DISTINCT a.industry FROM AlumniProfile a WHERE a.industry IS NOT NULL")
    List<String> findAllIndustries();
    
    @Query("SELECT DISTINCT a.currentCompany FROM AlumniProfile a WHERE a.currentCompany IS NOT NULL")
    List<String> findAllCompanies();
    
    @Query("SELECT a FROM AlumniProfile a WHERE a.id != :alumniId AND a.isProfilePublic = true")
    List<AlumniProfile> findAllExcept(@Param("alumniId") Long alumniId);
}
