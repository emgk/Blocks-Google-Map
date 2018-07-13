const { Component } = wp.element;

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
        return (
            <iframe
                width="100%"
                height="100%"
                src={`https://maps.google.com/maps?width=100%&height=600&hl=enq=''&q=${encodeURI(this.state.address)}&ll=${this.state.lat},${this.state.lng}&t=${this.state.type}&ie=UTF8&t=&z=14&iwloc=B&output=embed`}
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0"
            ></iframe>
        );
    }

}

export default GoogleMapContainer;

