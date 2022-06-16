using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerScore : MonoBehaviour
{
    private void OnDisable()
    {
        HighScoreManager.Instance.SetHighScoresInDataBase();
    }
}
