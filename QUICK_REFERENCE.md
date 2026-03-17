# 🎯 LocalMind - Quick Reference

## 📁 Project Structure

```
LocalMind/
├── src/                          # Laravel Backend (API)
│   ├── app/Http/Controllers/Api/ # API Controllers
│   ├── routes/api.php            # API Routes
│   └── config/cors.php           # CORS Configuration
│
├── frontend/                     # JavaScript Frontend
│   ├── index.html               # Main HTML
│   ├── css/style.css            # Styles
│   ├── js/
│   │   ├── api.js              # API Service
│   │   └── app.js              # App Logic
│   └── start.sh                # Start Script
│
├── docker-compose.yml           # Docker Configuration
├── API_DOCUMENTATION.md         # API Docs
└── JAVASCRIPT_GUIDE.md          # Frontend Guide
```

---

## 🚀 How to Run

### **Start Backend:**
```bash
cd /home/abde/Documents/local/LocalMind
docker-compose up -d
```

### **Start Frontend:**
```bash
cd /home/abde/Documents/local/LocalMind/frontend
./start.sh
```

### **Access:**
- Frontend: http://localhost:3000
- API: http://localhost:8000/api
- Database: localhost:5433

---

## 🔑 Key Files Explained

### **Backend (Laravel API)**

| File | Purpose |
|------|---------|
| `routes/api.php` | Defines all API endpoints |
| `app/Http/Controllers/Api/AuthController.php` | Login, Register, Logout |
| `app/Http/Controllers/Api/QuestionController.php` | Questions CRUD |
| `app/Http/Controllers/Api/CommentController.php` | Comments CRUD |
| `app/Http/Controllers/Api/FavoriteController.php` | Favorites |
| `config/cors.php` | Allow frontend to access API |

### **Frontend (JavaScript)**

| File | Purpose |
|------|---------|
| `index.html` | UI structure |
| `css/style.css` | Styling |
| `js/api.js` | All API calls (fetch) |
| `js/app.js` | UI logic & event handlers |

---

## 📡 API Endpoints

### **Public (No Auth):**
```
GET  /api/questions              # Get all questions
POST /api/register               # Register user
POST /api/login                  # Login user
```

### **Protected (Requires Token):**
```
POST   /api/logout               # Logout
GET    /api/questions/my         # My questions
POST   /api/questions            # Create question
PUT    /api/questions/{id}       # Update question
DELETE /api/questions/{id}       # Delete question
POST   /api/questions/{id}/comments      # Add comment
PUT    /api/comments/{id}                # Update comment
DELETE /api/comments/{id}                # Delete comment
POST   /api/questions/{id}/favorite      # Toggle favorite
GET    /api/favorites                    # Get favorites
```

---

## 🔐 Authentication Flow

```
1. User registers/logs in
   ↓
2. API returns token
   ↓
3. Frontend saves token in localStorage
   ↓
4. All protected requests include:
   Authorization: Bearer TOKEN
   ↓
5. API validates token
   ↓
6. Returns data or error
```

---

## 💻 Code Examples

### **JavaScript: Login**
```javascript
async function login() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    const response = await apiLogin(email, password);
    setToken(response.token);
    setUser(response.user);
    showMainContent(response.user);
}
```

### **JavaScript: Create Question**
```javascript
async function createQuestion() {
    const title = document.getElementById('questionTitle').value;
    const content = document.getElementById('questionContent').value;
    const location = document.getElementById('questionLocation').value;
    const date = document.getElementById('questionDate').value;
    
    await apiCreateQuestion(title, content, location, date);
    loadMyQuestions();
}
```

### **JavaScript: API Call**
```javascript
async function apiCall(endpoint, method = 'GET', body = null, requiresAuth = false) {
    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };
    
    if (requiresAuth) {
        headers['Authorization'] = `Bearer ${getToken()}`;
    }
    
    const response = await fetch(`${API_BASE_URL}${endpoint}`, {
        method,
        headers,
        body: body ? JSON.stringify(body) : null
    });
    
    return await response.json();
}
```

---

## 🧪 Testing with Postman

### **1. Register:**
```
POST http://localhost:8000/api/register
Body: {"name":"Test","email":"test@test.com","password":"123456"}
→ Copy token
```

### **2. Create Question:**
```
POST http://localhost:8000/api/questions
Headers: Authorization: Bearer YOUR_TOKEN
Body: {"title":"Test","content":"Content","location":"Casa","date":"2024-01-20"}
```

### **3. Get Questions:**
```
GET http://localhost:8000/api/questions
```

---

## 🐛 Troubleshooting

### **CORS Error:**
```bash
# Check CORS config exists
ls src/config/cors.php

# Restart Docker
docker-compose restart
```

### **401 Unauthenticated:**
- Check token in localStorage
- Login again
- Verify Authorization header

### **Database Not Running:**
```bash
docker ps  # Check containers
docker-compose up -d  # Start containers
```

### **Frontend Not Loading:**
```bash
# Check if server is running
lsof -i :3000

# Start server
cd frontend && python3 -m http.server 3000
```

---

## 📊 Database Access

### **Via Docker:**
```bash
docker exec -it laravel_postgress psql -U laravel_user -d laravel_db
```

### **Via GUI Tool:**
- Host: localhost
- Port: 5433
- Database: laravel_db
- User: laravel_user
- Password: password123

---

## 🎓 What You Learned

### **Backend:**
- ✅ Laravel API development
- ✅ RESTful API design
- ✅ Token authentication (Sanctum)
- ✅ CORS configuration
- ✅ Route model binding
- ✅ Validation
- ✅ Authorization

### **Frontend:**
- ✅ Vanilla JavaScript
- ✅ Fetch API
- ✅ Async/Await
- ✅ LocalStorage
- ✅ DOM manipulation
- ✅ Event handling
- ✅ Dynamic HTML rendering

### **Tools:**
- ✅ Docker & Docker Compose
- ✅ PostgreSQL
- ✅ Postman API testing
- ✅ Git version control

---

## 📚 Documentation Files

- `API_DOCUMENTATION.md` - Complete API reference
- `JAVASCRIPT_GUIDE.md` - Frontend deep dive
- `frontend/README.md` - Frontend setup guide
- `QUICK_REFERENCE.md` - This file

---

## 🚀 Quick Commands

```bash
# Start everything
docker-compose up -d
cd frontend && ./start.sh

# Stop everything
docker-compose down
# Ctrl+C in frontend terminal

# View logs
docker-compose logs -f

# Run migrations
docker exec laravel_app php artisan migrate

# Access database
docker exec -it laravel_postgress psql -U laravel_user -d laravel_db

# Clear cache
docker exec laravel_app php artisan cache:clear
```

---

## ✅ Features Checklist

- [x] User registration & login
- [x] Token-based authentication
- [x] Create questions
- [x] View all questions
- [x] View my questions
- [x] Search & filter questions
- [x] Delete questions
- [x] Add comments
- [x] Toggle favorites
- [x] View favorites
- [x] Responsive design
- [x] Error handling
- [x] CORS enabled

---

## 🎯 Next Steps

1. **Add Features:**
   - Display comments on questions
   - Edit questions
   - User profiles
   - Pagination

2. **Improve UI:**
   - Loading spinners
   - Toast notifications
   - Better error messages

3. **Deploy:**
   - Host on AWS/Heroku
   - Use production database
   - Enable HTTPS

---

**🎉 Your full-stack application is complete and ready to use!**

**Frontend:** http://localhost:3000  
**API:** http://localhost:8000/api
