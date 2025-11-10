# 🎓 Alumni Intelligence Service

A Java Spring Boot microservice providing AI-powered recommendations and analytics for the MBSTU Alumni Management System.

## Features

- 🤝 **Smart Networking Recommendations** - Find alumni to connect with based on multi-factor similarity
- 🎓 **Mentorship Matching** - Connect with senior alumni for career guidance
- 👥 **Batchmate Discovery** - Reconnect with classmates from your batch
- 📊 **Career Analytics** - Industry trends and alumni career insights
- 🏢 **Company Insights** - See where alumni are working

## Tech Stack

- **Java 17**
- **Spring Boot 3.2.0**
- **Spring Data JPA**
- **MySQL** (shared with Laravel)
- **Apache Commons Math** (for algorithms)
- **Maven** (dependency management)

## Quick Start

### Prerequisites

- Java JDK 17+
- Maven 3.6+
- MySQL (already running for Laravel)

### Run the Service

```bash
# Build project
mvn clean install

# Start service
mvn spring-boot:run
```

Service will start on **http://localhost:8081**

### Test Health Endpoint

```bash
curl http://localhost:8081/api/recommendations/health
```

## Configuration

Edit `src/main/resources/application.properties`:

```properties
spring.datasource.url=jdbc:mysql://localhost:3306/alumni_system
spring.datasource.username=root
spring.datasource.password=your_password
server.port=8081
```

## API Endpoints

### Recommendations

- `POST /api/recommendations` - Get personalized recommendations
- `GET /api/recommendations/{id}/networking` - Networking suggestions
- `GET /api/recommendations/{id}/mentorship` - Find mentors
- `GET /api/recommendations/{id}/batchmates` - Discover batchmates

### Analytics

- `GET /api/analytics/career?departmentId={id}` - Career analytics
- `GET /api/analytics/industry/{industry}` - Industry insights

## Algorithm

Uses **weighted multi-factor scoring**:

- Department similarity (20%)
- Industry match (25%)
- Batch year proximity (15%)
- Career level (15%)
- Same major (10%)
- Location (10%)
- Type-specific boost (15%)

Recommendations with score ≥ 30% are returned.

## Project Structure

```
src/main/java/edu/mbstu/alumni/
├── controller/          # REST API endpoints
├── service/            # Business logic & algorithms
├── repository/         # Database access
├── model/             # JPA entities
└── dto/               # Data transfer objects
```

## Integration with Laravel

The Laravel app communicates with this service via HTTP REST API.

See: `app/Services/AlumniIntelligenceService.php` in Laravel project.

## Development

```bash
# Run tests
mvn test

# Build JAR
mvn clean package

# Run JAR
java -jar target/alumni-intelligence-service-1.0.0.jar
```

## Documentation

See `/JAVA_INTEGRATION_GUIDE.md` in the main project for detailed documentation.

## License

MIT License - Same as parent Laravel project
