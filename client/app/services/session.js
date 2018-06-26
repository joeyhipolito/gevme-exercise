import Service from '@ember/service';
import { inject as service } from '@ember/service';

export default Service.extend({
  ajax: service(),
  username: null,
  userId: null,
  authenticated: false,

  login: function(username, callback) {
    this.get('ajax').request('http://gev.api/login', {
      method: 'POST',
      data: { username: username },
      contentType: 'application/json',
    }).then((data) => {
      this.set('authenticated', true);
      this.set('username', data.username);
      this.set('userId', data.id);
      callback();
    });
  },

  logout: function(callback) {
    this.set('authenticated', false);
    this.set('username', null);
    this.set('userId', null);
    callback();
  },

  isAuthenticated: function() {
    return this.get('authenticated');
  }
});
