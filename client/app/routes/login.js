import Route from '@ember/routing/route';
import { inject as service } from '@ember/service';

export default Route.extend({
  session: service(),

  actions: {
    loginUser() {
      let username = this.get('controller').get('username');
      this.get('session').login(username, () => {
        this.transitionTo('home');
      });
    }
  }
});
