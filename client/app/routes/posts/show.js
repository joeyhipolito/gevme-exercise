import Authenticated from '../authenticated';
import { inject as service } from '@ember/service';

export default Authenticated.extend({
  ajax: service(),
  model(params) {
    return this.store.findRecord('post', params.id);
  },
  // afterModel(post) {
  //   return this.get('ajax').request('http://gev.api/histories', {
  //     method: 'GET',
  //     data: { postId: post.id }
  //   }).then((data) => {
  //     this.set('histories', data);
  //   });
  // },

  setupController: function(controller, model) {
    this._super(controller, model);
    controller.set('post', model);
  }
});
