# Build a Fully Functional Software as a Service Project (SaaS)

This is a fully functional Software as a Service (SaaS) project using Laravel 11, React, Tailwind.css, and Stripe for online payments. This project is designed to provide a robust foundation for any SaaS application, with features tailored for credit-based usage and seamless payment integration.

All credits go to @Codeholic on yt. Amazing mastermind!

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features

This project includes the following features:

🔹 **Create Features and Charge Credits:** Users can access various features by using credits. Each feature has a specified credit cost.

🔹 **Feature Management:** Control which features are published on the website directly from the database.

🔹 **Credit Assignment:** Assign the required number of credits to each feature.

🔹 **Free Credits on Registration:** Specify the number of free credits given to users upon registration.

🔹 **Credit Deduction:** Automatically deduct credits when a user utilizes a feature.

🔹 **Feature Blocking:** Block access to features if the user does not have enough credits.

🔹 **Package Management:** Define multiple tiers of credit packages, including the number of credits and the price for each package.

🔹 **Stripe Integration:** Implement Stripe to allow users to purchase more credits.

🔹 **Usage Tracking:** Track the history of feature usage for each user.

## Technologies Used

- **Laravel 11:** Backend framework to handle server-side logic and database interactions.
- **React:** Frontend library for building user interfaces.
- **Tailwind.css:** Utility-first CSS framework for styling.
- **Stripe:** Payment processing platform to handle credit purchases.

## Installation

Follow these steps to set up the project on your local machine:

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/tarzann419/laravel-react-saas.git
   cd saas-project
   ```

2. **Install Backend Dependencies:**

   ```bash
   composer install
   ```

3. **Install Frontend Dependencies:**

   ```bash
   npm install
   ```

4. **Set Up Environment Variables:**

   Copy the `.env.example` file to `.env` and update the necessary settings, especially database and Stripe API keys.

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run Migrations:**

   ```bash
   php artisan migrate
   ```

6. **Start the Development Server:**

   ```bash
   php artisan serve
   npm run dev
   ```

## Usage

After setting up the project, you can start using the application by navigating to `http://localhost:8000` in your browser. Here are some key functionalities:

- **Registration and Login:** Create an account and log in to access features.
- **Feature Access:** Utilize available features and monitor credit usage.
- **Purchase Credits:** Buy additional credits through Stripe payment integration.
- **Admin Controls:** Use admin functionalities to manage features and credit packages.

## Contributing

We welcome contributions to improve this project! Here’s how you can contribute:

1. **Fork the Repository:**

   Click the "Fork" button at the top right of this page to create a copy of this repository in your GitHub account.

2. **Clone Your Fork:**

   ```bash
   git clone https://github.com/tarzann419/laravel-react-saas.git
   cd laravel-react-saas
   ```

3. **Create a Branch:**

   ```bash
   git checkout -b feature-branch
   ```

4. **Make Your Changes:**

   Implement your changes and commit them with clear and concise messages.

5. **Push to Your Fork:**

   ```bash
   git push origin feature-branch
   ```

6. **Create a Pull Request:**

   Navigate to the original repository and click the "New Pull Request" button to submit your changes for review.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

---

Thank you for checking out this project! We look forward to your contributions and hope this project helps you build a powerful SaaS application. If you have any questions or need further assistance, feel free to open an issue or contact us.