const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;

registerBlockType('custom/popup-block', {
    title: 'Popup Block',
    icon: 'smiley',
    category: 'layout',
    attributes: {
        content: {
            type: 'string',
            source: 'html',
            selector: 'p',
        },
    },
    edit({ attributes, setAttributes }) {
        const { content } = attributes;
        return (
            <RichText
                tagName="p"
                className="popup-content"
                value={content}
                onChange={(content) => setAttributes({ content })}
                placeholder="Enter popup content..."
            />
        );
    },
    save({ attributes }) {
        const { content } = attributes;
        return <RichText.Content tagName="p" value={content} />;
    },
});
