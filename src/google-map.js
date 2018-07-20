const { Component } = wp.element;
import { generateGoogleMapIframe } from './actions';

export class GoogleMapContainer extends Component {
    constructor(props) {
        super(...arguments);

        this.state = {
            lat: props.lat,
            lng: props.lng,
            address: props.address,
            type: 'm'
        };
    }

    render() {
        return generateGoogleMapIframe(this.state.lat, this.state.lng, this.state.address);
    }
}

export default GoogleMapContainer;

