import DS from 'ember-data';

export default DS.Model.extend({
  posts: DS.hasMany('post', { async: true }),

  username: DS.attr('string')
});
