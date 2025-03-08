import { ethers } from "ethers";
import LoteriaPrognosticosABI from "./contracts/LoteriaPrognosticos.json";

const contractAddress = "0x8fa024467a4ab1286e78da4a876d18abaea667a38f1e2679069ce6b1ee8663d7"; // Endereço do contrato deployado
const provider = new ethers.providers.Web3Provider(window.ethereum);
const signer = provider.getSigner();
const contract = new ethers.Contract(contractAddress, LoteriaPrognosticosABI, signer);
