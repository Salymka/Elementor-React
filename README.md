# Start template for Elementor-React Addon

# Elementor React Addon Starter Pack

This WordPress plugin serves as a simple starter pack for developing Elementor widgets with ReactJS. It provides a foundation for creating custom Elementor addons using modern JavaScript and React components.

## Project Structure

```
custom-elementor-react-addon/
├── assets/
│   ├── css/
│   │   └── main.css
│   └── js/
│       └── main.js
├── src/
│   ├── widgets/
│   ├── components/
│   └── index.js
├── widgets/
│   ├── widget-1.php
│   └── widget-2.php
├── custom-elementor-react-addon.php
├── index.html (for testing)
├── vite.config.js
└── setup.sh (for auto-generating plugin folder)
```

## Features

- Easy setup with auto-generation script
- React integration for Elementor widgets
- Vite for fast development and optimized builds
- Sample widgets to get you started
- Docker support for easy local development

## Prerequisites

- WordPress installation
- Elementor plugin installed and activated
- Node.js and npm installed on your development machine
- Docker and Docker Compose (optional, for local development)

## Getting Started

1. Clone this repository or download the zip file.
2. Run the setup script to create your plugin folder:
   ```
   ./setup.sh
   ```
3. Enter your desired plugin name when prompted, or press Enter to use the default name.

## Development

1. Navigate to your plugin directory:

   ```
   cd your-plugin-name
   ```

2. Install dependencies:

   ```
   npm install
   ```

3. Edit the React components in the `src/widgets/` directory.

4. Modify the PHP widget files in the `widgets/` directory to add or change Elementor controls.

## Building for Production

When you're ready to use your addon in a live WordPress site:

1. Build the production assets:

   ```
   npm run build
   ```

2. The build process will update `assets/js/main.js` and `assets/css/main.css` with the production-ready code.

## Using with Docker (Optional)

If you prefer to develop using a local WordPress environment with Docker:

1. Ensure Docker and Docker Compose are installed on your machine.

2. Run the setup script to create a packaged version of your plugin:

   ```
   ./setup.sh
   ```

3. Navigate to your created plugin directory:

   ```
   cd your-plugin-name
   ```

4. From your plugin directory, start the Docker containers:

   ```
   docker-compose up -d
   ```

5. Access your local WordPress site at `http://localhost:8000`.

6. Activate your plugin from the WordPress admin panel and install Elementor.

## Adding New Widgets

1. Create a new PHP file in the `widgets/` directory (e.g., `widget-3.php`).
2. Create a corresponding React component in `src/widgets/`.
3. Register the new widget in `custom-elementor-react-addon.php`.
4. Add the widget initialization to `src/index.js`.

## Customization

- Modify `vite.config.js` to adjust the build process if needed.
- Update `custom-elementor-react-addon.php` to change plugin details or add new features.

## Troubleshooting

- If your widgets are not appearing in Elementor, ensure the plugin is activated and the widget is properly registered.
- Check the browser console for any JavaScript errors.
- Verify that the built assets are being enqueued correctly in WordPress.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the GPL v2 or later.

## Acknowledgements

- [Elementor](https://elementor.com/) for the amazing page builder
- [React](https://reactjs.org/) for the frontend library
- [Vite](https://vitejs.dev/) for the build tool
