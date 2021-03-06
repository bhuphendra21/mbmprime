describe( 'Filter Clear', () => {
	beforeAll( () => {
		String.prototype.className = function() {
			if (
				(
					'string' !== typeof this &&
					! this instanceof String /* eslint-disable-line no-unsafe-negation */
				) ||
				'function' !== typeof this.replace
			) {
				return this;
			}

			return this.replace( '.', '' );
		};

		global.tribe = {};
		require( '../filter-clear' );
	} );

	afterAll( () => {
		delete String.prototype.className;
		delete global.tribe;
	} );

	describe( 'Selectors', () => {
		test( 'Should match snapshot', () => {
			const selectors = JSON.stringify( tribe.filterBar.filterClear.selectors );
			expect( selectors ).toMatchSnapshot();
		} );
	} );

	describe( 'Handle clear click', () => {
		let windowHold;

		beforeEach( () => {
			windowHold = global.window;
			delete global.window.location;
			global.window = Object.create( window );
			// url = 'https://test.tri.be/events/month/?range=0-50'
			global.window.location = {
				href: 'https://test.tri.be/events/month/?tribe_eventcategory[0]=hello&tribe_eventcategory[1]=world&tribe_cost=0-100&tribe_custom=moderntribe', // eslint-disable-line max-len
				origin: 'https://test.tri.be',
				pathname: '/events/month/',
				search: '?tribe_eventcategory[0]=hello&tribe_eventcategory[1]=world&tribe_cost=0-100&tribe_custom=moderntribe', // eslint-disable-line max-len
				hash: '',
			};
			global.tribe.filterBar.filters = {
				removeKeyValueFromQuery: jest.fn().mockImplementation( () => ( {} ) ),
				submitRequest: jest.fn(),
				getCurrentUrl: jest.fn().mockImplementation( () => ( {} ) ),
				getCurrentUrlAsObject: jest.fn().mockImplementation( () => ( {} ) ),
			};
		} );

		afterEach( () => {
			global.window = windowHold;
		} );

		test( 'Should clear filters', () => {
			// Setup test.
			const container = `
				<div>
					<button
						class="tribe-filter-bar__selected-filter"
						data-js="tribe-filter-bar__selected-filter"
						data-filter-name="tribe_eventcategory[]"
					>
					</button>
					<button
						class="tribe-filter-bar__selected-filter"
						data-js="tribe-filter-bar__selected-filter"
						data-filter-name="tribe_cost"
					>
					</button>
					<button
						class="tribe-filter-bar__selected-filter"
						data-js="tribe-filter-bar__selected-filter"
						data-filter-name="tribe_custom"
					>
					</button>
				</div>
			`;
			const $container = $( container );
			const event = {
				data: {
					container: $container,
				},
			};

			// Test.
			tribe.filterBar.filterClear.handleClearClick( event );

			// Confirm final states.
			expect( tribe.filterBar.filters.removeKeyValueFromQuery.mock.calls.length ).toBe( 3 );
			expect( tribe.filterBar.filters.submitRequest.mock.calls.length ).toBe( 1 );
		} );

		test( 'Should not change url if no selected filters', () => {
			// Setup test.
			const $container = $( '<div></div>' );
			const event = {
				data: {
					container: $container,
				},
			};

			// Test.
			tribe.filterBar.filterClear.handleClearClick( event );

			// Confirm final states.
			expect( tribe.filterBar.filters.removeKeyValueFromQuery.mock.calls.length ).toBe( 0 );
			expect( tribe.filterBar.filters.submitRequest.mock.calls.length ).toBe( 1 );
		} );

		test( 'Should not change url if pills do not have data-filter-name attribute', () => {
			// Setup test.
			const container = `
				<div>
					<button
						class="tribe-filter-bar__selected-filter"
						data-js="tribe-filter-bar__selected-filter"
					>
					</button>
					<button
						class="tribe-filter-bar__selected-filter"
						data-js="tribe-filter-bar__selected-filter"
					>
					</button>
					<button
						class="tribe-filter-bar__selected-filter"
						data-js="tribe-filter-bar__selected-filter"
					>
					</button>
				</div>
			`;
			const $container = $( container );
			const event = {
				data: {
					container: $container,
				},
			};

			// Test.
			tribe.filterBar.filterClear.handleClearClick( event );

			// Confirm final states.
			expect( tribe.filterBar.filters.removeKeyValueFromQuery.mock.calls.length ).toBe( 0 );
			expect( tribe.filterBar.filters.submitRequest.mock.calls.length ).toBe( 1 );
		} );
	} );
} );
