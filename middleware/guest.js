export default function({ $auth, redirect }) {
  let user = $auth.user;

  if (user) {
    return redirect("/dashboard");
  }
}
