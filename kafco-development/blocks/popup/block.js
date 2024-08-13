const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;
const { useBlockProps, InspectorControls } = wp.blockEditor;
const { Fragment } = wp.element;

registerBlockType('custom/popup-block', {
    title: 'Popup Block',
    icon: 'smiley',
    category: 'common',
    attributes: {
        content: {
            type: 'string',
            default: 'This is a popup!'
        },
    },
    edit({ attributes, setAttributes }) {
        const blockProps = useBlockProps();
        return (
            <Fragment>
                <InspectorControls>
                    <TextControl
                        label="Popup Content"
                        value={attributes.content}
                        onChange={(newContent) => setAttributes({ content: newContent })}
                    />
                </InspectorControls>
                <div {...blockProps}>
                    <button className="custom-popup-trigger">Open Popup</button>
                    <div className="custom-popup-content">
                        {attributes.content}
                    </div>
                </div>
            </Fragment>
        );
    },
    save({ attributes }) {
        const blockProps = useBlockProps.save();
        return (
            <div {...blockProps}>
                <button className="custom-popup-trigger">Open Popup</button>
                <div className="custom-popup-content">
                    {attributes.content}
                </div>
            </div>
        );
    },
});
