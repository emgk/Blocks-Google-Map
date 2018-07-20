const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

// Import actions.
import { edit, generateGoogleMapIframe } from './actions';

/**
 * Register the gutenberg map block inside the embed category.
 * 
 * @since 1.0.0.
 */
registerBlockType('gutenberg-map-block/main-map-block', {
    title: __('Map'),
    icon: 'location',
    category: 'embed',
    attributes: {
        latitute: {
            type: "number",
        },
        longitude: {
            type: "number"
        },
        tip: {
            type: "string"
        },
        address: {
            type: "string"
        }
    },
    edit,
    save: props => {
        return (
            <div className={props.className}>
                <iframe
                    width="100%"
                    height="500px"
                    src={`https://maps.google.com/maps?width=100%&height=600&hl=enq=''&q=${encodeURI(props.attributes.address)}&ll=${props.attributes.latitute},${props.attributes.longitude}&ie=UTF8&t=&z=14&iwloc=B&output=embed`}
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                ></iframe>
            </div>
        )
    }
});
