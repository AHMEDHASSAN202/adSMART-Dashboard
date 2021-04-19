require('./bootstrap');
import { App } from '@inertiajs/inertia-react';
import React from 'react';
import {render} from 'react-dom';
import 'react-sortable-tree/style.css';

const el = document.getElementById('app')

render(
    <App
        initialPage={JSON.parse(el.dataset.page)}
        resolveComponent={name => require(`./Dashboard/Pages/${name}`).default}
    />,
    el
);
