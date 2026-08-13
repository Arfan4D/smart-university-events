import test from 'node:test';
import assert from 'node:assert/strict';
test('announcement payload contains a message',()=>{const payload={message:'Room changed to CSE Lab 4'};assert.equal(typeof payload.message,'string');assert.ok(payload.message.length>0)});
