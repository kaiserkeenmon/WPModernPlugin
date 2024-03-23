/**
 * Template file for a Gutenberg block.
 *
 * This template registers a new block type with static text.
 * You should customize this template according to your block's requirements.
 *
 * - 'editor.scss' styles are applied in the editor only.
 * - 'styles.scss' styles are applied both in the editor and front-end.
 * - Modify the block namespace and name as needed.
 */

import { registerBlockType } from '@wordpress/blocks';

registerBlockType('your-namespace/sample-block', {
    title: 'Sample Block',
    category: 'widgets',

    edit: () => {
        return (
            <div>
                <p>Edit mode: This is an example block.</p>
            </div>
        );
    },

    save: () => {
        return (
            <div>
                <p>Frontend mode: This is an example block.</p>
            </div>
        );
    },
});
