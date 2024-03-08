/**
 * Template file for a Gutenberg block.
 *
 * It imports necessary CSS files and uses the @wordpress/blocks package to register a new block type.
 * You should customize this template according to your block's requirements.
 *
 * - 'editor.scss' styles are applied in the editor only.
 * - 'styles.scss' styles are applied both in the editor and front-end.
 * - Modify the block namespace and name as needed.
 * - The edit function defines the block's appearance and behavior in the editor.
 * - The save function defines the block's saved content and structure.
 *
 * Modify this template with additional attributes and functionality as needed.
 */

import { registerBlockType } from '@wordpress/blocks';
import { TextControl, Button } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

registerBlockType('your-namespace/sample-block', {
    title: 'Sample Block',
    category: 'widgets',

    // Define block attributes
    attributes: {
        text: {
            type: 'string',
            default: 'Default text',
        },
    },

    edit: ({ attributes, setAttributes }) => {
        // Use useState for the input field, initializing it with the block attribute value
        const [inputValue, setInputValue] = useState(attributes.text);

        // Update the inputValue when attributes.text changes
        // This ensures the input field is updated with saved content when the editor loads
        useEffect(() => {
            setInputValue(attributes.text);
        }, [attributes.text]);

        // Handle the submission of the input field's value
        const handleSubmission = () => {
            // Example API call using apiFetch
            apiFetch({
                path: '/wp/v2/posts', // Specify the path of the API endpoint
                method: 'GET', // Set the HTTP method
            }).then((posts) => {
                console.log(posts); // Log the response to the console
            });

            // Update the block's text attribute with the input value
            setAttributes({ text: inputValue });
        };

        return (
            <div>
                <TextControl
                    label="Input Text"
                    value={inputValue}
                    onChange={(value) => setInputValue(value)}
                    placeholder={'Enter some text...'}
                />
                <Button
                    isPrimary
                    onClick={handleSubmission}
                >
                    Submit
                </Button>
            </div>
        );
    },

    save: ({ attributes }) => {
        // Render the saved attribute value on the front end
        return (
            <div>
                {attributes.text}
            </div>
        );
    },
});
