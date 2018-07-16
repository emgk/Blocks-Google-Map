const { Component, Fragment } = wp.element;
const { PanelBody } = wp.components;
const { InspectorControls } = wp.editor;
const { __ } = wp.i18n;

import { GoogleMapContainer } from './google-map';
import PlacesAutocomplete, {
    geocodeByAddress,
    getLatLng,
} from 'react-places-autocomplete';

/**
 * Code contains for edit action.
 * 
 * @since 1.0.0.
 */
export class edit extends Component {
    constructor(props) {
        super(...arguments);

        this.state = {
            address: this.props.attributes.address,
            latitute: this.props.attributes.latitute,
            longitude: this.props.attributes.longitude,
            tipImage: this.props.attributes.tip || "tip-1"
        };
    }
}
