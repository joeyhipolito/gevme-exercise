import Route from '@ember/routing/route';

export default Route.extend({
  model(params) {
    return this.store.findRecord('user', params.id);
  },
  setupController: function(controller, model) {
    this._super(controller, model);
    controller.set('user', model);
  }
});

