<a name="readme-top">

<br/>

<br />
<div align="center">
  <a href="https://github.com/PDAConcepcion/">
    <img src="/assets/img/murimrun-wordmark-red.png" alt="Nyebe"  height="70">
  </a>
  <h3 align="center">MURIM RUN - Swift As The Blade!</h3>
</div>
<div align="center">
  Murim Run is a web-based delivery management system inspired by martial arts sects. Users can register, log in, and place delivery orders by selecting couriers from various sects, tracking package status, and managing deliveries in real time. The platform features authentication, dynamic courier selection, and a PostgreSQL backend for robust data handling.
</div>

<br />

![](https://visit-counter.vercel.app/counter.png?page=PDAConcepcion/MurimRun_Finals)

[![wakatime](https://wakatime.com/badge/user/d4319e56-afb6-4209-8b83-a830d88d13cd/project/f2847942-f9a8-44f4-b222-ecc91f53b99c.svg)](https://wakatime.com/badge/user/d4319e56-afb6-4209-8b83-a830d88d13cd/project/f2847942-f9a8-44f4-b222-ecc91f53b99c)

---

<br />
<br />

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#overview">Overview</a>
      <ol>
        <li>
          <a href="#key-components">Key Components</a>
        </li>
        <li>
          <a href="#technology">Technology</a>
        </li>
      </ol>
    </li>
    <li>
      <a href="#rule,-practices-and-principles">Rules, Practices and Principles</a>
    </li>
    <li>
      <a href="#resources">Resources</a>
    </li>
  </ol>
</details>

---

## Overview

Murim Run is a web-based delivery management system themed around martial arts sects. The platform allows users to register, log in, and place delivery orders by selecting couriers from different sects. Users can track the status of their packages and manage deliveries in real time. The system features secure authentication, dynamic courier selection, and a PostgreSQL backend for reliable data storage and management. Designed for both usability and scalability, Murim Run streamlines the delivery process with an engaging interface and robust backend logic.

### Key Components

- **User Authentication & Authorization:** Secure registration and login system to protect user data and restrict access to authorized users.
- **Courier Management:** Dynamic listing and selection of couriers from various martial arts sects, each with unique attributes and availability.
- **Delivery Order Placement:** Users can create new delivery orders by filling out package details and selecting a courier.
- **Real-Time Delivery Tracking:** Users can view and track the status of their deliveries and receive updates.
- **Admin & Utility Handlers:** Backend scripts for database migration, seeding, and resetting to support development and maintenance.
- **PostgreSQL Integration:** All data is stored and managed in a PostgreSQL database for reliability and scalability.
- **Responsive UI:** Modern, user-friendly interface built with HTML, CSS, JavaScript, and PHP.

### Technology

#### Language

![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

#### Framework/Library

![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

#### Databases

![MySQL](https://img.shields.io/badge/MySQL-00758F?style=for-the-badge&logo=mysql&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-336791?style=for-the-badge&logo=postgresql&logoColor=white)

## Rules, Practices and Principles

<!-- Do not Change this -->

1. Always use `AD-` in the front of the Title of the Project for the Subject followed by your custom naming.
2. Do not rename `.php` files if they are pages; always use `index.php` as the filename.
3. Add `.component` to the `.php` files if they are components code; example: `footer.component.php`.
4. Add `.util` to the `.php` files if they are utility codes; example: `account.util.php`.
5. Place Files in their respective folders.
6. Different file naming Cases
   | Naming Case | Type of code | Example |
   | ----------- | -------------------- | --------------------------------- |
   | Pascal | Utility | Accoun.util.php |
   | Camel | Components and Pages | index.php or footer.component.php |
7. Renaming of Pages folder names are a must, and relates to what it is doing or data it holding.
8. Use proper label in your github commits: `feat`, `fix`, `refactor` and `docs`
9. File Structure to follow below.

```
AD-ProjectName
└─ assets
|   └─ css
|   |   └─ name.css
|   └─ img
|   |   └─ name.jpeg/.jpg/.webp/.png
|   └─ js
|       └─ name.js
└─ components
|   └─ name.component.php
|   └─ templates
|      └─ name.component.php
└─ handlers
|   └─ name.handler.php
└─ layout
|   └─ name.layout.php
└─ pages
|  └─ pageName
|     └─ assets
|     |  └─ css
|     |  |  └─ name.css
|     |  └─ img
|     |  |  └─ name.jpeg/.jpg/.webp/.png
|     |  └─ js
|     |     └─ name.js
|     └─ index.php
└─ staticData
|  └─ name.staticdata.php
└─ utils
|   └─ name.utils.php
└─ vendor
└─ .gitignore
└─ bootstrap.php
└─ composer.json
└─ composer.lock
└─ index.php
└─ readme.md
└─ router.php
```

> The following should be renamed: name.css, name.js, name.jpeg/.jpg/.webp/.png, name.component.php(but not the part of the `component.php`), Name.utils.php(but not the part of the `utils.php`)

## Resources

<!-- TODO: Add References -->

| Title               | Purpose                                     | Link            |
| ------------------- | ------------------------------------------- | --------------- |
| Github Copilot Chat | Code structure and logic refinement         |                 |
| ChatGPT             | Code structure and logic refinement         | www.chatgpt.com |
| w3schools           | for JS and CSS design tips and improvements | w3schools.com   |
| Unsplash            | stock images                                | unsplash.com    |
| pinterest           | stock images                                | pinterest.com   |
