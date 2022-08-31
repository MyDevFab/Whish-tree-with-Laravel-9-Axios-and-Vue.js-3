import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Auth from '../views/Auth.vue'
import ProfileView from '../views/ProfileView.vue'
import TreeDetails from '../components/tree/TreeDetails.vue'
import UsersList from '../components/UsersList.vue'
import ShowTodo from '../components/todo/ShowTodo.vue'
import StarterGuide from '../components/StarterGuide.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    beforeEnter: (to, from, next) => {
      if(!localStorage.getItem('user_token') || !localStorage.getItem('user_id')) {
        return next({
          name: 'auth'
        })
      }
      else next()
    }
  },
  {
    path: '/auth',
    name: 'auth',
    component: Auth
  },
  {
    path: '/users-list',
    name: 'usersList',
    component: UsersList,
    beforeEnter: (to, from, next) => {
      if(!localStorage.getItem('user_token') || !localStorage.getItem('user_id')) {
        return next({
          name: 'auth'
        })
      }
      else next()
    }
  },
  {
    path: '/profile/:id',
    name: 'profile',
    component: ProfileView,
    props: true,
    beforeEnter: (to, from, next) => {
      if(!localStorage.getItem('user_token') || !localStorage.getItem('user_id')) {
        return next({
          name: 'auth'
        })
      }
      else next()
    }
  },
  {
    path: '/tree/:id',
    name: 'tree',
    component: TreeDetails,
    props: true,
    beforeEnter: (to, from, next) => {
      if(!localStorage.getItem('user_token') || !localStorage.getItem('user_id')) {
        return next({
          name: 'auth'
        })
      }
      else next()
    }
  },
  {
    path: '/tree/:id/resolution/:resolution_id/:resolution_title',
    name: 'todos',
    component: ShowTodo,
    props: true,
    beforeEnter: (to, from, next) => {
      if(!localStorage.getItem('user_token') || !localStorage.getItem('user_id')) {
        return next({
          name: 'auth'
        })
      }
      else next()
    }
  },
  {
    path: '/starter-guide',
    name: 'guide',
    component: StarterGuide,
    meta: {
      title: 'Starter Guide'
    },
    beforeEnter: (to, from, next) => {
      if(!localStorage.getItem('user_token') || !localStorage.getItem('user_id')) {
        return next({
          name: 'auth'
        })
      }
      else next()
    }
  },
]




const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

// ... 

// This callback runs before every route change, including on page load.
router.beforeEach((to, from, next) => {
  // This goes through the matched routes from last to first, finding the closest route with a title.
  // e.g., if we have `/some/deep/nested/route` and `/some`, `/deep`, and `/nested` have titles,
  // `/nested`'s will be chosen.
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  // Find the nearest route element with meta tags.
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);

  const previousNearestWithMeta = from.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);

  // If a route with a title was found, set the document (page) title to that value.
  if(nearestWithTitle) {
    document.title = nearestWithTitle.meta.title;
  } else if(previousNearestWithMeta) {
    document.title = previousNearestWithMeta.meta.title;
  }

  // Remove any stale meta tags from the document using the key attribute we set below.
  Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));

  // Skip rendering meta tags if there are none.
  if(!nearestWithMeta) return next();

  // Turn the meta tag definitions into actual elements in the head.
  nearestWithMeta.meta.metaTags.map(tagDef => {
    const tag = document.createElement('meta');

    Object.keys(tagDef).forEach(key => {
      tag.setAttribute(key, tagDef[key]);
    });

    // We use this to track which meta tags we create so we don't interfere with other ones.
    tag.setAttribute('data-vue-router-controlled', '');

    return tag;
  })
  // Add the meta tags to the document head.
  .forEach(tag => document.head.appendChild(tag));

  next();
});

// ...
export default router
