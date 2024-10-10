# Slinkinator - URL Shortener API

This is a simple Laravel-based API that shortens URLs using a public URL shortening service (TinyURL). The API also implements Bearer Token authorization where the token is validated based on a custom rule involving balanced brackets, braces, and parentheses.

## Features

- **URL Shortening**: Receives a URL and returns a shortened version using a public shortening service.
- **Bearer Token Authorization**: Protects the endpoint with a Bearer Token that must contain a valid sequence of `{}`, `[]`, and `()`.
- **Well-formed Token Validation**: Ensures that the Bearer Token provided follows the correct opening and closing of braces, brackets, and parentheses.
- **Unit and Feature Testing**: The API includes tests for both the functionality of URL shortening and token validation.

## API Documentation

### Endpoint: `POST /api/v1/short-urls`

#### Request

- **Authorization Header**: Bearer Token (required)
- **Body Parameters**:
  - `url` (string, required): The URL to be shortened.

#### Example Request

```
POST /api/v1/short-urls
Authorization: Bearer []{}

{
    "url": "http://www.example.com"
}
```

#### Response

Returns a JSON object with the shortened URL:

```
{
    "url": "https://tinyurl.com/12345"
}
```

If the Bearer token is invalid or malformed, the API will return a `401 Unauthorized` response.

#### Token Validation Rules

- The Bearer token must consist only of the characters `{}`, `[]`, `()`.
- The token is valid if all opening characters are properly closed in the correct order.
- An empty token is considered valid.

#### Examples of Valid Tokens

- `{}`
- `[]{}()`
- `{([])}`
- Empty token

#### Examples of Invalid Tokens

- `{)`
- `[{]}`
- `(((((((()`

## Installation

1. Clone the repository:

    ```
    git clone https://github.com/Artessan/slinkinator.git
    ```

2. Navigate to the project directory:

    ```
    cd slinkinator
    ```

3. Install dependencies:

    ```
    composer install
    ```

4. Set up the environment:

    ```
    cp .env.example .env
    php artisan key:generate
    ```

5. Serve the application:

    ```
    php artisan serve
    ```

## Running Tests

To run the tests, use the following command:

```
php artisan test
```

This will execute both unit and feature tests, including tests for token validation and URL shortening.

## Project Structure

- **Middleware**: The `ValidateBearerToken` middleware is responsible for handling Bearer Token validation based on the bracket-matching problem.
- **Controller**: The `UrlShortenerController` handles the business logic for shortening URLs and returning the result.
- **Value Objects**: The `Url` value object is used to encapsulate URL validation.
- **Service**: The logic to call the public URL shortening service is encapsulated in a service class for better separation of concerns.

## Design Decisions

- **Middleware**: The validation for the Bearer token is handled through middleware to ensure separation of concerns and allow for token validation to be reused across multiple endpoints if needed.
- **Domain Value Object**: The `Url` value object encapsulates URL validation, making the code cleaner and more maintainable.
- **Public API**: The choice of a public URL shortening service (TinyURL) allows the application to focus on core logic while outsourcing URL shortening.

