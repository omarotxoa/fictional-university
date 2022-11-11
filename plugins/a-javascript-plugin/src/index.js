wp.blocks.registerBlockType("ajp/a-javascript-plugin", {
  title: "A Javascript Plugin",
  icon: "smiley",
  category: "common",
  edit: function() {
    return (
      <div>
        <p>Test from our new js block</p>
      </div>
    )
  },
  save: function() {
    return (
      <>
        <div>Frontend Test</div>
      </>
    )
  }
});