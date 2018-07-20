const { Component } = wp.element;
import { generateGoogleMapIframe } from './actions';

/**
 * Class to Render the Google Map iFrame.
 * 
 * @since 1.0.0
 */
export class GoogleMapContainer extends Component {
   render() {
        return generateGoogleMapIframe(this.props.lat, this.props.lng, this.props.address, this.props.maptype);
    }
}

export default GoogleMapContainer;

