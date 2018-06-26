import Route from '@ember/routing/route';
import { inject as service } from '@ember/service';

export default Route.extend({
  session: service(),
  actions: {
    logoutUser() {
      this.get('session').logout(() => {
        this.transitionTo('login');
      });
    }
  }
});
