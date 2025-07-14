# API Routes Testing Guide

## Overview
This guide provides information on testing your Laravel API endpoints. All Swagger/OpenAPI documentation has been removed from the project.

## Authentication Routes
- POST `/api/register` - Register a new user
- POST `/api/login` - Login user
- POST `/api/logout` - Logout user (requires auth)

## Public Routes (No Authentication Required)
- GET `/api/categories` - Get all categories
- GET `/api/categories/{id}` - Get specific category
- GET `/api/event-packages` - Get all event packages
- GET `/api/event-packages/{id}` - Get specific event package
- GET `/api/offers` - Get all active offers
- GET `/api/offers/{id}` - Get specific offer
- GET `/api/reviews` - Get all reviews

## Authenticated User Routes (Requires Bearer Token)
- GET `/api/user` - Get authenticated user info
- POST `/api/reviews` - Create a review
- GET `/api/bookings` - Get user's bookings (or all if admin)
- POST `/api/bookings` - Create a booking
- GET `/api/bookings/{id}` - Get specific booking
- PUT `/api/bookings/{id}` - Update booking
- DELETE `/api/bookings/{id}` - Cancel booking

## Admin Only Routes (Requires Bearer Token + Admin Role)
- POST `/api/categories` - Create category
- PUT `/api/categories/{id}` - Update category
- DELETE `/api/categories/{id}` - Delete category
- POST `/api/event-packages` - Create event package
- PUT `/api/event-packages/{id}` - Update event package
- DELETE `/api/event-packages/{id}` - Delete event package
- POST `/api/offers` - Create offer
- PUT `/api/offers/{id}` - Update offer
- DELETE `/api/offers/{id}` - Delete offer
- GET `/api/reviews/{id}` - Get specific review
- PUT `/api/reviews/{id}` - Update review
- DELETE `/api/reviews/{id}` - Delete review

## Testing Examples

### Register a user:
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "phone_no": "1234567890"
  }'
```

### Login:
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Create a category (admin only):
```bash
curl -X POST http://localhost:8000/api/categories \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "Wedding",
    "image_file_id": "optional_image_id"
  }'
```

### Get all categories (public):
```bash
curl -X GET http://localhost:8000/api/categories \
  -H "Accept: application/json"
```
