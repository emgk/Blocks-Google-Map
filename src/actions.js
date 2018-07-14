const { Component, Fragment } = wp.element;
const { PanelBody } = wp.components;
const { InspectorControls } = wp.editor;
const { __ } = wp.i18n;

import { GoogleMapContainer } from './google-map';
import PlacesAutocomplete, {
    geocodeByAddress,
    getLatLng,
} from 'react-places-autocomplete';

