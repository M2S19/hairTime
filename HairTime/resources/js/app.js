import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import React from 'react';
import ReactDOM from 'react-dom';

function App() {
    return <h1>Hello, React!</h1>;
}

if (document.getElementById('react-root')) {
    ReactDOM.render(<App />, document.getElementById('react-root'));
}

