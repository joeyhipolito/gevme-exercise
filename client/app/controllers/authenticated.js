import Controller from '@ember/controller';
import { inject as service } from '@ember/service';
import { computed } from '@ember/object';

export default Controller.extend({
  session: service(),
  isAuthenticated: computed('session.authenticated', {
    get() {
      return this.get('session').isAuthenticated();
    }
  })
});
