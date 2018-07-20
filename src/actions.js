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

    /**
     * When change the address, change it in state too.
     * 
     * @since 1.0.0
     */
    handleWhenAddressChange(address) {
        this.setState({ address });
    }

    /**
     * Get the geo location code when choose then Place.
     * 
     * @since 1.0.0
     */
    handleChoosePlace(address) {
        const { setAttributes } = this.props;

        // Get geo code by selected address.
        geocodeByAddress(address)
            .then(results => {

                // Set the formatted address.
                this.setState({ address: results[0].formatted_address });
                setAttributes({ address: results[0].formatted_address });

                // Get the co-ordinate of the map.
                getLatLng(results[0])
                    .then(coordinate => {
                        let mapOrigin = {
                            latitute: coordinate.lat,
                            longitude: coordinate.lng,
                        };

                        this.setState(mapOrigin);

                        // Chnage the attirbute's values.
                        setAttributes(mapOrigin);
                    });

            })
            .catch(err => console.error('Error', err));
    }
    render() {
        return (
            <Fragment>
                <div className="gutenberg-map">
                    <div className="gutenberg-map-field-title">
                        {
                            typeof this.state.latitute === "number"
                                && typeof this.state.longitude === "number"
                                ?
                                <div style={{ width: '100%', height: '250px' }}>
                                    {console.log(this.state.address)}
                                    <GoogleMapContainer lat={this.state.latitute} lng={this.state.longitude} address={this.state.address} tipImage={this.state.tipImage} />
                                </div>
                                : <div className="place-select-container" style={{ width: '100%', height: '250px' }}>
                                    <PlacesAutocomplete
                                        value={this.state.address}
                                        onChange={this.handleWhenAddressChange.bind(this)}
                                        onSelect={this.handleChoosePlace.bind(this)}
                                    >
                                        {({ getInputProps, suggestions, getSuggestionItemProps, loading }) => (
                                            <div>
                                                <input
                                                    {...getInputProps({
                                                        placeholder: 'Enter your location',
                                                        className: 'gutenberg-map-location-search-input',
                                                    })}
                                                />
                                                <div className="autocomplete-dropdown-container">
                                                    {loading && <div>Loading...</div>}
                                                    {suggestions.map(suggestion => {
                                                        const className = suggestion.active
                                                            ? 'suggestion-item--active'
                                                            : 'suggestion-item';
                                                        // inline style for demonstration purpose
                                                        const style = suggestion.active
                                                            ? { backgroundColor: '#fafafa', cursor: 'pointer' }
                                                            : { backgroundColor: '#ffffff', cursor: 'pointer' };
                                                        return (
                                                            <div
                                                                {...getSuggestionItemProps(suggestion, {
                                                                    className,
                                                                    style,
                                                                })}
                                                            >
                                                                <span>{suggestion.description}</span>
                                                            </div>
                                                        );
                                                    })}
                                                </div>
                                            </div>
                                        )}
                                    </PlacesAutocomplete>
                                </div>
                        }
                    </div>
                </div>

                <InspectorControls>

                </InspectorControls>
            </Fragment>
        );
    }
}

/**
 * Generate iFrame for Google Map.
 * 
 * @since 1.0.0
 * @param {} param
 */
export const generateGoogleMapIframe = (lat, lag, address) => {
    return (
        <iframe
            width="100%"
            height="100%"
            src={`https://maps.google.com/maps?width=100%&height=600&hl=enq=''&q=${encodeURI(address)}&ll=${lat},${lag}&ie=UTF8&t=&z=14&iwloc=B&output=embed`}
            frameborder="0"
            scrolling="no"
            marginheight="0"
            marginwidth="0"
        ></iframe>
    )
}