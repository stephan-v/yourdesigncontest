import Vue from 'vue';
import Comments from './comments/Comments.vue';
import store from '../store';

export default { title: 'Comments' };

export const component = () => ({
    store,
    components: { Comments },
    template: '<comments route="test">rounded</comments>',
});
