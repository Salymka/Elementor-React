import React from 'react';
import { createRoot } from 'react-dom/client';
import './globalStyles.css';
import Widget1 from './widgets/widget1/widget1';
import Widget2 from './widgets/widget2/widget2';

const initWidget = (WidgetElement, widgetClassName) => {
  const widgets = document.querySelectorAll(widgetClassName);

  if (widgets.length === 0) {
    return;
  }

  widgets.forEach((widget) => {
    try {
      const data = JSON.parse(widget.dataset.settings) || null;
      const root = createRoot(widget);
      root.render(
        <React.StrictMode>
          <WidgetElement data={data} />
        </React.StrictMode>
      );
    } catch (error) {
      console.error('Error initializing widget:', error);
      widget.textContent = 'Error loading widget';
    }
  });
};

const init = () => {
  initWidget(Widget1, '.custom-widget-1');
  initWidget(Widget2, '.custom-widget-2');
};

window.addEventListener('elementor/frontend/init', function () {
  if (typeof elementor !== 'undefined') {
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/custom-widget-1.default',
      init
    );
    elementorFrontend.hooks.addAction(
      'frontend/element_ready/custom-widget-2.default',
      init
    );
  }
});

window.addEventListener('DOMContentLoaded', init);
