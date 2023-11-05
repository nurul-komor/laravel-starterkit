
![Logo](https://entreprogrammer.jp/wp-content/uploads/2023/08/LaravelNext.js.png)



# Laravel Starter kit

JWT Starter Kit with SOLID Design: A robust boilerplate for building secure web applications using JSON Web Tokens (JWT) and adhering to SOLID design principles.


## API Reference

### User authentication



---

## User Registration

### Register a new user.

```http
POST /api/auth/register
```

| Parameter             | Type        | Description                  |
|-----------------------|-------------|------------------------------|
| `name`                | `string`    | **Required**. User's name.   |
| `email`               | `string,email` | **Required**. User's email. |
| `password`            | `string`    | **Required**. User's password. |
| `password_confirmation` | `string` | **Required**. Confirm password (must match `password`). |

---

## User Login

### Authenticate a user and obtain an access token.

```http
POST /api/auth/login
```

| Parameter | Type     | Description                       |
|-----------|----------|-----------------------------------|
| `email`   | `string` | **Required**. User's email.       |
| `password`| `string` | **Required**. User's password.    |

---



    

#### Get User Profile

- **Endpoint**: `/api/auth/profile`
- **Method**: `GET`
- **Description**: Retrieve the user's profile information.

**Request**:

- Headers:
  - `Authorization: Bearer YOUR_API_TOKEN`

**Response**:

- Status: 200 OK
- Body:

```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    // Additional user profile data
}
```


## User Profile Update

### Update the user's profile.


- **Endpoint**: `/api/auth/update-profile`
- **Method**: `GET`
- **Description**: Retrieve the user's profile information.

**Request**:

- Headers:
  - `Authorization: Bearer YOUR_API_TOKEN`

**Response**:

- Status: 200 OK
- Body:

```json
{
    "status": true,
    "message" : "Profile Updated Successfully"
}
```

---

## Password Reset

### Request a password reset.

```http
POST /api/auth/reset-password
```

| Parameter | Type     | Description                          |
|-----------|----------|--------------------------------------|
| `email`   | `string,email` | **Required**. User's email for password reset. |

---

## Delete Account

### Delete the user's account.

```http
DELETE /api/auth/delete-account
```

| Parameter | Type     | Description                              |
|-----------|----------|------------------------------------------|
| `email`   | `string,email` | **Required**. User's email for account deletion. |
| `password`| `string` | **Required**. User's password for confirmation. |

---

## Get User Profile

### Retrieve the user's profile.

```http
GET /api/auth/get-profile
```

No additional parameters are required. Authentication token is needed.

---

## Logout

### Log the user out.

```http
GET /api/auth/logout
```

No additional parameters are required. Authentication token is needed.

---


