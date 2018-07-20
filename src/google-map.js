const { Component } = wp.element;
import { generateGoogleMapIframe } from './actions';

export class GoogleMapContainer extends Component {
    constructor(props) {
        super();
    }

    render() {
        return generateGoogleMapIframe(this.props.lat, this.props.lng, this.props.address, this.props.maptype);
    }
}

export default GoogleMapContainer;

