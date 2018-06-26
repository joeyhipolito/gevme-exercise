import DS from 'ember-data';

export default DS.RESTSerializer.extend({
  serialize(record, options) {
    console.log('YES ITS BLOODY USING THE REST SERIALIZER');
    this._super(record, options);
  }
});
