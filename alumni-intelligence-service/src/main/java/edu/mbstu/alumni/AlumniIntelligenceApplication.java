package edu.mbstu.alumni;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class AlumniIntelligenceApplication {
    
    public static void main(String[] args) {
        SpringApplication.run(AlumniIntelligenceApplication.class, args);
        System.out.println("🎓 Alumni Intelligence Service Started on port 8081");
    }
}
