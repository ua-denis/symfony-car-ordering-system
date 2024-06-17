# Car Ordering System

This project is a Car Ordering System built using PHP 8.2 and Symfony 7.1. The system allows users to place orders for
various types of cars with different configurations. The orders are processed through a series of build checkpoints with
event logging and notifications.

## Features

- Order various types of cars (e.g., Trucks, Cars, SUVs, Electric, Hybrid, Luxury).
- Configurable options include engine type and size, body type, transmission type and speeds, interior trim levels,
  color, and additional options.
- Logging and notification mechanisms at each build checkpoint.
- Notifications sent to the client via email upon completion of the build.
- Extensible and modular design following Clean Architecture and Hexagonal Architecture principles.
- Adherence to Clean Code principles, SOLID, DRY, KISS, YAGNI, and Law of Demeter.

## Installation

### Prerequisites

- PHP 8.2
- Composer
- Symfony CLI
- A running MySQL database instance

### Steps

1. Install dependencies:

   ```sh
   composer install
   ```

2. Create a `.env.local` file and set up your database credentials:

   Update the following line in `.env.local` with your database configuration:

   ```dotenv
   DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0"
   MAILER_DSN=null://null
   EMAIL_FROM=your-email-from
   ```

## Usage

### Placing an Order

You can place an order using the Symfony Console command:

```sh
php bin/console app:order-car <type> <engineType> <engineSize> <transmissionType> <transmissionSpeeds> <body> <color> <interior> [<options>...]
```

Example:

```sh
php bin/console app:order-car Hybrid V6 3.0L Automatic 6 Sedan Red Leather Sunroof GPS
```

### Available Options

- **type**: Car type (e.g., Truck, SUV, Electric, Hybrid, Luxury)
- **engineType**: Engine type (e.g., V6, V8, Electric)
- **engineSize**: Engine size (e.g., 3.0L, 4.0L)
- **transmissionType**: Transmission type (e.g., Automatic, Manual)
- **transmissionSpeeds**: Number of speeds (e.g., 6, 8)
- **body**: Body type (e.g., Sedan, Coupe, Hatchback)
- **color**: Color (e.g., Red, Blue, Black)
- **interior**: Interior trim (e.g., Leather, Cloth)
- **options**: Additional options (e.g., Sunroof, GPS, Bluetooth)

## Architecture

The application follows Clean Architecture and Hexagonal Architecture principles:

- **Domain Layer**: Contains the business logic and domain entities.
- **Application Layer**: Contains the use cases and DTOs.
- **Infrastructure Layer**: Contains the repository implementations, services, and event handling.
- **Presentation Layer**: Contains the Symfony console commands and controllers.

### Event Handling

The system uses event handlers to log events and send notifications during the car build process. Events are dispatched
at various checkpoints to ensure that the process is tracked and monitored.

### Logging and Notifications

- **LogService**: Logs important events and errors.
- **EmailService**: Sends notifications to clients via email.

## Extending the System

To add more car configurations or extend the event handling system, follow these steps:

1. Define new entities or DTOs as needed.
2. Implement new use cases or extend existing ones.
3. Add new event handlers or modify existing ones to handle new events.
4. Update the configuration files to register new services or handlers.