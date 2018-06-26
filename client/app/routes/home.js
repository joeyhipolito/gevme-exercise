import Authenticated from './authenticated';
import { hash } from 'rsvp';

export default Authenticated.extend({
  model() {
    return hash({
      posts: this.store.query('post', { userId: this.get('session').userId })
    })
  },
  setupController: function(controller, model) {
    this._super(controller, model);
    controller.set('posts', model.posts);
  }
});
