const backendEnv = "__BACKEND_URL__";
const apiUrl = backendEnv.startsWith("__") ? "http://" + window.location.hostname + ":8080" : backendEnv;
