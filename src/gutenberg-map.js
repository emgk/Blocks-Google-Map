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
        address: {
            type: "string"
        },
        maptype: {
            type: "string"
        }
    },
    edit,
    save: props => {
        return (
            <div className={props.className}>
                {generateGoogleMapIframe(props.attributes.latitute, props.attributes.longitude, props.attributes.address, props.attributes.maptype)}
            </div>
        )
    }
});
