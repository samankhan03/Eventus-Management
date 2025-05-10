<template>
<aside
  class="flex flex-col w-full sm:w-1/3 lg:w-1/4 bg-black min-h-[70vh] max-h-[90vh] overflow-y-auto mr-[-5px] pt-0 pb-1 rounded-md"
>



    <!-- Sidebar Links Container -->
    <div>
      <inertia-link
        :href="link.route"
        v-for="link in sideBarLinks"
        :key="link.name"
        class="flex items-center pl-6 py-1.5 space-x-2 group"  
        :class="route().current(link.route) ? 'text-gray-800 hover:bg-gray-500 hover:text-white' : 'text-white hover:bg-gray-500 hover:text-black'"
      >
        <img
          :src="link.image"
          :alt="link.alt"
          class="h-8 w-8 rounded-full object-cover"
          v-if="link.image"
        />
      <icon
          :name="link.icon"
          class="fill-current w-8 h-8 text-white group-hover:text-black" 
          v-if="link.icon"
        />
        <span>{{ link.name }}</span>
      </inertia-link>
    </div>
  </aside>
</template>

<script>
export default {
  computed: {
    sideBarLinks() {
      if (!this.$page.props.user) return []; // Return an empty array if user data is not available
      return [
        {
          name: `${this.$page.props.user.username}`,
          image: `${this.$page.props.user.profile_photo_url}`,
          alt: `${this.$page.props.user.username}`,
          route: route('profiles.show', `${this.$page.props.user.username}`),
        },
        { name: 'Edit Profile', route: route('profile.show'), icon: 'user-edit' },
        { name: 'Friends', route: route('friends.index'), icon: 'user-friends' },
        { name: 'Members', route: route('members.index'), icon: 'users' },
        { name: 'Study Rooms', route: route('chat-rooms.index'), icon: 'comments' },
        { name: 'Add an Event', route: route('events.create'), icon: 'events' },
        { name: 'Upcoming Events', route: route('events.index'), icon: 'clock' },
        { name: 'My Tickets', route: route('events.tickets'), icon: 'tickets' },
      ];
    },
  },
};
</script>

<style>
aside {
  height: 100%; /* Sidebar height */
  margin-top: 0; /* Avoid negative margins */
  padding-top: 0;
  padding-bottom: 1.5rem;
  overflow-y: auto; /* Allow scrolling if needed */
  background-color: black; /* Black background for the entire sidebar */
  width: 90%;
  border: 1px solid white;
}

aside a:hover {
  background-color: #4a5568; /* Hover background color */
}

aside a.active {
  background-color: #2d3748; /* Active link background color */
}

aside a + a {
  border-top: 1px solid white; /* Add a line between links */
}

*, *::before, *::after {
  box-sizing: border-box;
}
</style>
