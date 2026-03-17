# LocalMind API Documentation

Your Laravel application has been converted to a REST API that returns JSON responses.

## Setup

1. Run migrations to create the `personal_access_tokens` table:
```bash
php artisan migrate
```

## Base URL
```
http://your-domain.com/api
```

## Authentication

The API uses Laravel Sanctum for token-based authentication. Include the token in the Authorization header:
```
Authorization: Bearer YOUR_TOKEN_HERE
```

## Endpoints

### Authentication

#### Register
```http
POST /api/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

Response:
```json
{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "user"
  },
  "token": "1|abc123..."
}
```

#### Login
```http
POST /api/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

Response:
```json
{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  },
  "token": "2|xyz789..."
}
```

#### Logout
```http
POST /api/logout
Authorization: Bearer YOUR_TOKEN
```

Response:
```json
{
  "message": "Logged out successfully"
}
```

### Questions

#### Get All Questions
```http
GET /api/questions?search=keyword&location=city&sort=distance
```

Response:
```json
[
  {
    "id": 1,
    "title": "Question Title",
    "content": "Question content...",
    "location": "New York",
    "date": "2024-01-15",
    "user_id": 1,
    "created_at": "2024-01-10T10:00:00.000000Z",
    "updated_at": "2024-01-10T10:00:00.000000Z",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
  }
]
```

#### Create Question (Authenticated)
```http
POST /api/questions
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "title": "My Question",
  "content": "Question details...",
  "location": "New York",
  "date": "2024-01-15"
}
```

Response:
```json
{
  "id": 1,
  "title": "My Question",
  "content": "Question details...",
  "location": "New York",
  "date": "2024-01-15",
  "user_id": 1,
  "created_at": "2024-01-10T10:00:00.000000Z",
  "updated_at": "2024-01-10T10:00:00.000000Z"
}
```

#### Get My Questions (Authenticated)
```http
GET /api/questions/my
Authorization: Bearer YOUR_TOKEN
```

#### Update Question (Authenticated)
```http
PUT /api/questions/{id}
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "title": "Updated Title",
  "content": "Updated content...",
  "location": "Boston",
  "date": "2024-01-20"
}
```

#### Delete Question (Authenticated)
```http
DELETE /api/questions/{id}
Authorization: Bearer YOUR_TOKEN
```

Response:
```json
{
  "message": "Question deleted successfully"
}
```

### Comments

#### Add Comment (Authenticated)
```http
POST /api/questions/{question_id}/comments
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "content": "This is my comment"
}
```

Response:
```json
{
  "id": 1,
  "user_id": 1,
  "question_id": 1,
  "content": "This is my comment",
  "created_at": "2024-01-10T10:00:00.000000Z",
  "updated_at": "2024-01-10T10:00:00.000000Z"
}
```

#### Update Comment (Authenticated)
```http
PUT /api/comments/{id}
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "content": "Updated comment"
}
```

#### Delete Comment (Authenticated)
```http
DELETE /api/comments/{id}
Authorization: Bearer YOUR_TOKEN
```

Response:
```json
{
  "message": "Comment deleted successfully"
}
```

### Favorites

#### Toggle Favorite (Authenticated)
```http
POST /api/questions/{question_id}/favorite
Authorization: Bearer YOUR_TOKEN
```

Response:
```json
{
  "favorited": true,
  "message": "Added to favorites"
}
```

#### Get Favorites (Authenticated)
```http
GET /api/favorites
Authorization: Bearer YOUR_TOKEN
```

Response:
```json
[
  {
    "id": 1,
    "title": "Favorite Question",
    "content": "Content...",
    "location": "New York",
    "date": "2024-01-15",
    "user": {
      "id": 2,
      "name": "Jane Doe"
    }
  }
]
```

## Error Responses

### Validation Error (422)
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

### Unauthorized (401)
```json
{
  "message": "Unauthenticated."
}
```

### Forbidden (403)
```json
{
  "message": "Unauthorized"
}
```

## Testing with cURL

### Register
```bash
curl -X POST http://your-domain.com/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password123"}'
```

### Login
```bash
curl -X POST http://your-domain.com/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password123"}'
```

### Get Questions
```bash
curl http://your-domain.com/api/questions
```

### Create Question (with token)
```bash
curl -X POST http://your-domain.com/api/questions \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"title":"Test","content":"Content","location":"NYC","date":"2024-01-15"}'
```

## Notes

- All API routes are prefixed with `/api`
- The web routes (returning views) are still available at their original paths
- Both web and API authentication work independently
- API uses token-based auth (Sanctum), web uses session-based auth
