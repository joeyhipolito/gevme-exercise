import { module, test } from 'qunit';
import { setupTest } from 'ember-qunit';

module('Unit | Route | history/index', function(hooks) {
  setupTest(hooks);

  test('it exists', function(assert) {
    let route = this.owner.lookup('route:history/index');
    assert.ok(route);
  });
});
