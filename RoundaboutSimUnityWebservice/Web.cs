using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.SceneManagement;

public class Web : MonoBehaviour
{
    // Start is called before the first frame update
    void Start()
    {
        //StartCoroutine(GetUsers());
        //StartCoroutine(Login("test","123"));
        //StartCoroutine(RegisterUser("daniel1", "fff", "yo@yo.com"));
    }

   IEnumerator GetUsers() {
        using (UnityWebRequest www = UnityWebRequest.Get("http://localhost/RoundaboutSimUnityBackend/GetUsers.php")) {
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError) {
                Debug.Log(www.error);
            }
            else
            {
                Debug.Log(www.downloadHandler.text);

                byte[] results = www.downloadHandler.data;
            }
        }
    }

    public IEnumerator Login(string username, string password)
    {
        WWWForm form = new WWWForm();
        form.AddField("loginUser", username);
        form.AddField("loginPass", password);

        using (UnityWebRequest www = UnityWebRequest.Post("http://localhost/RoundaboutSimUnityBackend/Login.php", form))
        {
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                Debug.Log(www.downloadHandler.text);
                SceneManager.LoadScene(SceneManager.GetActiveScene().buildIndex + 1);
            }
        }
    }

    public IEnumerator RegisterUser(string username, string password, string email)
    {
        WWWForm form = new WWWForm();
        form.AddField("loginUser", username);
        form.AddField("loginPass", password);
        form.AddField("loginEmail", email);

        using (UnityWebRequest www = UnityWebRequest.Post("http://localhost/RoundaboutSimUnityBackend/RegisterUser.php", form))
        {
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                Debug.Log(www.downloadHandler.text);
                SceneManager.LoadScene(SceneManager.GetActiveScene().buildIndex + 1);
            }
        }
    }
}
